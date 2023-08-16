import axios from "@/_lib/axios";

export default async function useRequest(method, url, ...props) {
  let data = []
  let error = ''

  try {
    const res = await axios.request({
      method: method,
      url: url,
      ...props,
    })
    data = res.data
  } catch (err) {
    error = err
  }

  return {data, error}
}