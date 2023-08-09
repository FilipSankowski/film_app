'use client'

import FormCard from "@/_components/FormCard";
import Input from "@/_components/Input";
import Label from "@/_components/Label";
import { useState } from "react"

export const metadata = {
  title: 'Admin Panel'
}

function UserForm() {
  const [name, setName] = useState('');
  const [password, setPassword] = useState('');

  const submit = (e) => {

  }

  return (
    <div className="bg-gray-300">
      <FormCard>
        <form onSubmit={submit}>
          {/* Username */}
          <Label htmlFor={'name'}>Name</Label>
          <Input
            id="name"
            type="text"
            value={name}
            className="block mt-1 w-full"
            onChange={event => setName(event.target.value)}
            required
            autoFocus
          />

          {/* Password */}
          <Label htmlFor={'password'}>Password</Label>
          <Input
            id="password"
            type="password"
            value={password}
            className="block mt-1 w-full"
            onChange={event => setPassword(event.target.value)}
            required
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