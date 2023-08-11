import axios from "@/_lib/axios";
import { useEffect, useState } from "react";
import useSWR from "swr";

export default function useRequest() {
  // const config = body
  //   ? {
  //       method: method,
  //       data: body
  //     }
  //   : {
  //       method: method
  //     }
    
  const {data, error} = useSWR('/api/users', () => {
    // fetch(`http://laravel:8000${url}`, config)
    //   .then(res => res.json())

    axios.get('/api/users')
      .then(res => res.data)
      .catch(error => {
        throw error
      })
  })

  return {data, error}
}