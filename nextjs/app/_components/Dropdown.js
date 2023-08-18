'use client'

import { useState } from "react"

export default function Dropdown({header, children, className = '', ...props}) {
  const [isOpen, setIsOpen] = useState(false)

  return (
    <div 
      className={`${className} bg-gray-500`}
      {...props}  
    >
      <button className={'w-full py-1 px-2 bg-gray-500 text-white font-bold hover:bg-gray-400'} onClick={() => setIsOpen(!isOpen)}>  
        <span className={'inline-block align-middle'}>{header}</span>
        <span className={'inline-block align-middle'}>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" className="w-5 h-5">
            <path fillRule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clipRule="evenodd" />
          </svg>
        </span>
      </button>
      
      
      <div 
        className={
          isOpen
            ? 'block overflow-auto'
            : 'hidden'
        }
      >
        {children}
      </div>

    </div>
  )
}