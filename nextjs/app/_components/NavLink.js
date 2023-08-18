import Link from 'next/link'

const NavLink = ({children, ...props }) => (
    <Link
        {...props}
        className={`inline-flex items-center w-full p-3 text-white font-bold border-b-2 text-sm font-medium border-indigo-400 leading-5 focus:border-indigo-700 focus:outline-none hover:bg-indigo-500 transition duration-150 ease-in-out`}
    >
        {children}
    </Link>
)

export default NavLink
