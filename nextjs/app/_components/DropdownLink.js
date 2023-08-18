import Link from "next/link"

export default function DropdownLink({children, className = '', ...props}) {
  return (
      <Link
        className={`${className} block py-1 px-2 bg-gray-500 text-white hover:bg-gray-400`}
        {...props}
      >
        {children}
      </Link>
  )
}