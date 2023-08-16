'use client'

import FormCard from "@/_components/FormCard";
import Input from "@/_components/Input";
import Label from "@/_components/Label";
import Select from "@/_components/Select";
import SelectOptions from "@/_components/SelectOptions";
import useRequest from "@/_hooks/request";
import axios from "@/_lib/axios";
import { useEffect, useState } from "react"
import useSWR from "swr";

export const metadata = {
  title: 'Admin Panel'
}

// export async function getStaticProps() {
//   const response = await axios.request({
//     url: '/users',
//     method: 'GET',
//     headers: {
//       'Content-Type': 'x-www-form-urlencoded',
//     },
//   })
//   const data = data.data;
  
//   return {props: {data}}
// }

export default function UserForm({userData}) {
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

  console.log('Page data: ', userData);

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