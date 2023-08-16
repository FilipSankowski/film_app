'use client'

import Button from "@/_components/Button";
import FormCard from "@/_components/FormCard";
import Input from "@/_components/Input";
import Label from "@/_components/Label";
import Select from "@/_components/Select";
import SelectOptions from "@/_components/SelectOptions";
import { useState } from "react"

export default function UserForm({userData: {data, error}}) {
  if (error) throw error

  const actionOptions = [
    {
      name: 'Dodaj',
      value: 'PUT'
    },
    {
      name: 'Aktualizuj',
      value: 'POST'
    },
    {
      name: 'Usuń',
      value: 'DELETE'
    }
  ]
  const userOptions = data.map(user => {return {name: user.name, value: user.id}})

  const [action, setAction] = useState(actionOptions[0].value);
  const [name, setName] = useState('');
  const [password, setPassword] = useState('');
  const [userId, setUserId] = useState(userOptions[0].value);

  const submit = (e) => {
    e.preventDefault()

    switch (action) {
      case 'PUT': {
        console.log('Name: ', name, '; Password: ', password);
        break;
      }
      case 'POST': {
        console.log('UserId: ', userId, '; Name: ', name, '; Password: ', password);
        break;
      }
      case 'DELETE': {
        console.log('UserId: ', userId);
        break;
      }
    }
  }

  return (
    <div className="bg-gray-300">
      <FormCard>
        <form onSubmit={submit}>
          {/* Action */}
          <div>
            <Label htmlFor={'action'}>Akcja</Label>
            <Select
              id='action'
              value={action}
              className="block mt-1 w-full mb-4"
              onChange={(event) => {setAction(event.target.value)}}
              required
              autoFocus
            >
              <SelectOptions options={actionOptions} />
            </Select>
          </div>

          {/* Add user */}
          {action === 'PUT'
          ? <div>
            <Label htmlFor={'name'}>Nazwa użytkownika</Label>
            <Input
              id="name"
              type="text"
              value={name}
              className="block mt-1 mb-4 w-full"
              onChange={(event) => {setName(event.target.value)}}
              required
            />
        
            <Label htmlFor={'password'}>Hasło</Label>
            <Input
              id="password"
              type="text"
              value={password}
              className="block mt-1 mb-4 w-full"
              onChange={(event) => {setPassword(event.target.value)}}
              required
            />
            </div>

          /* Update user */
          : action === 'POST'
          ? <div>
            <Label htmlFor={'userId'}>Użytkownik</Label>
            <Select
              id='userId'
              value={userId}
              className="block mt-1 mb-4 w-full"
              onChange={(event) => {setUserId(event.target.value)}}
              required
            >
              <SelectOptions options={userOptions} />
            </Select>

            <Label htmlFor={'name'}>Nowa nazwa użytkownika</Label>
            <Input
              id="name"
              type="text"
              value={name}
              className="block mt-1 mb-4 w-full"
              onChange={(event) => {setName(event.target.value)}}
              required
            />
        
            <Label htmlFor={'password'}>Nowe hasło</Label>
            <Input
              id="password"
              type="text"
              value={password}
              className="block mt-1 mb-4 w-full"
              onChange={(event) => {setPassword(event.target.value)}}
              required
            />
            </div>

          /* Delete user */
          : action === 'DELETE'
          ? <div>
            <Label htmlFor={'userId'}>Użytkownik</Label>
            <Select
              id='userId'
              value={userId}
              className="block mt-1 mb-4 w-full"
              onChange={(event) => {setUserId(event.target.value)}}
              required
            >
              <SelectOptions options={userOptions} />
            </Select>
            </div>
          : <div>
            Invalid method
            </div>
          }

          {/* Submit */}
          <div className={'w-full flex justify-items-end'}>
            <Button>
              Wyślij
            </Button>
          </div>

        </form>
      </FormCard>
    </div>
  )
}