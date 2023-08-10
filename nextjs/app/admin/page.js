'use client'

import FormCard from "@/_components/FormCard";
import Input from "@/_components/Input";
import Label from "@/_components/Label";
import Select from "@/_components/Select";
import SelectOptions from "@/_components/SelectOptions";
import { useState } from "react"

export const metadata = {
  title: 'Admin Panel'
}

function UserForm() {
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
  const [name, setName] = useState('');
  const [password, setPassword] = useState('');
  const [action, setAction] = useState(options[0].method);

  const submit = (e) => {
    e.preventDefault()
  }

  console.log(action);

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

          {/* Username */}
          <Label htmlFor={'name'}>Nazwa użytkownika</Label>
          <Input
            id="name"
            type="text"
            value={name}
            className="block mt-1 w-full"
            onChange={(event) => {setName(event.target.value)}}
            hidden={action === 'DELETE'}
          />

          {/* Password */}
          <Label htmlFor={'password'}>Hasło</Label>
          <Input
            id="password"
            type="text"
            value={password}
            className="block mt-1 w-full"
            onChange={(event) => {setPassword(event.target.value)}}
            hidden={action === 'DELETE'}
          />
        </form>
      </FormCard>
    </div>
  )
}

export default function Admin() {
  return (
    <UserForm />
  )
}