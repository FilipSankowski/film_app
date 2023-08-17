import axios from "@/_lib/axios";

export default async function useRequest(method, url, ...props) {
  let result = {}

  try {
    const res = await axios.request({
      method: method,
      url: url,
      ...props,
    })
    result = {data: res.data, status: res.status}
  } catch (err) {
    result = {...result, error: err}
  }

  return result
}