import useRequest from "@/_hooks/request"
import UserForm from "./UserForm"

export const metadata = {
  title: 'Admin Panel'
}

export default async function Admin() {
  const userData = await useRequest('GET', '/users')
  return (
    <UserForm userData={userData} />
  )
}