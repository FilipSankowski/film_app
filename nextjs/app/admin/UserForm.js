import FormCard from "@/_components/FormCard";
import Input from "@/_components/Input";
import Label from "@/_components/Label";
import Select from "@/_components/Select";
import SelectOptions from "@/_components/SelectOptions";
import useRequest from "@/_hooks/request";
import axios from "@/_lib/axios";
import { useEffect, useState } from "react"

export const metadata = {
  title: 'Admin Panel'
}

export default function UserForm() {
  const options = [
    {
      label: 'Dodaj',
      method: 'PUT'
    },
    {
      label: 'Aktualizuj',
      method: 'POST'
    },
    {
      label: 'Usuń',
      method: 'DELETE'
    }
  ]

  const [action, setAction] = useState(options[0].method);
  const [name, setName] = useState('');
  const [password, setPassword] = useState('');
  const [uid, setUid] = useState('');

  const submit = (e) => {
    e.preventDefault()
  }

  // const {users, error} = useRequest('get', 'users');
  // useEffect(() => {
  //   if (error) throw error
  //   console.log('Users: ', users)
  // }, [users, error])

  useEffect(() => {
    axios.request({
      method: 'GET',
      url: '/users',
    })
      .then(res => console.log('Axios res data: ', res.data))
      .catch(error => console.warn('Axios error: ', error))

    // fetch('http://localhost:8000/api/users', {
    //   method: 'GET',
    //   creditentials: 'include',
    //   headers: {
    //     'Content-Type': 'application/x-www-form-urlencoded'
    //   }
    // })
    //   .then(res => console.log('Fetch res data: ', res.json()))
    //   .catch(error => console.warn('Fetch error: ', error))
  }, [])

  return (
    <div className="bg-gray-300">
      <FormCard>
        <form onSubmit={submit}>
          {/* Action */}
          <Label htmlFor={'action'}>Akcja</Label>
          <Select
            id='action'
            value={action}
            className="block mt-1 w-full"
            onChange={(event) => {setAction(event.target.value)}}
            required
            autoFocus
          >
            <SelectOptions options={options} />
          </Select>

          {/* Add user */}
          {action === 'PUT'
          ? <>
            <Label htmlFor={'name'}>Nazwa użytkownika</Label>
            <Input
              id="name"
              type="text"
              value={name}
              className="block mt-1 w-full"
              onChange={(event) => {setName(event.target.value)}}
              required
            />
        
            <Label htmlFor={'password'}>Hasło</Label>
            <Input
              id="password"
              type="text"
              value={password}
              className="block mt-1 w-full"
              onChange={(event) => {setPassword(event.target.value)}}
              required
            />
            </>

          /* Update user */
          : action === 'POST'
          ? <>
            <Label htmlFor={'name'}>Nowa nazwa użytkownika</Label>
            <Input
              id="name"
              type="text"
              value={name}
              className="block mt-1 w-full"
              onChange={(event) => {setName(event.target.value)}}
              required
            />
        
            <Label htmlFor={'password'}>Nowe hasło</Label>
            <Input
              id="password"
              type="text"
              value={password}
              className="block mt-1 w-full"
              onChange={(event) => {setPassword(event.target.value)}}
              required
            />
            </>

          /* Delete user */
          : action === 'DELETE'
          ? <>
            Just DELETE lol
            </>
          : <>
            Invalid method
            </>
          }

        </form>
      </FormCard>
    </div>
  )
}