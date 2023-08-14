import axios from "@/_lib/axios";
import { useEffect, useState } from "react";
import useSWR from "swr";

export default function useRequest(method, url, params = null) {
  const headers = {
    'Content-Type': 'application/x-www-form-urlencoded',
  }
  const config = params
    ? {
        url: url,
        method: method,
        data: params,
        headers: headers,
      }
    : {
        url: url,
        method: method,
        headers: headers,
      }
    
  const {data, error} = useSWR(url, () => {
    // fetch(`${apiUrl}${url}`, config)
    //   .then(res => res.json())

    axios.request(config)
      .then(res => res.data)
      .catch(error => console.warn('axios error: ', error))

    // axios.get('/api/users')
    //   .then(res => res.data)
    //   .catch(error => {
    //     throw error
    //   })
  })

  return {data, error}
}