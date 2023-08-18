import useRequest from "@/_hooks/request"
import UserForm from "./UserForm"

export default async function UserDisplay() {
  const users = await useRequest('GET', '/users')
  return (
    <div>
      <UserForm users={users} />
    </div>
  )
}