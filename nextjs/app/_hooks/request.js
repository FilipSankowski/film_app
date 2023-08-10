import axios from "@/_lib/axios";
import useSWR from "swr";

export function useRequest({method, url, body = {}}) {
  const {data, error} = useSWR(url, () => {
    axios({
      method: method,
      url: url,
      data: body
    })
      .then(res => res.data)
      .catch(error => {
        throw error;
      })
  })
  if (error) {throw error}
  if (data) {return data}
}