import axios from "@/_lib/axios";
import UserForm from "./UserForm"

async function getData() {
  const res = await axios.request({
    url: '/users',
    method: 'GET',
    headers: {
      'Content-Type': 'x-www-form-urlencoded',
    },
  })
  const data = res.data;
  
  return data
}

export default async function Admin() {
  const data = await getData()
  return (
    <UserForm userData={data} />
  )
}