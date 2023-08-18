import NavLink from "./_components/NavLink";

export default function RootNavBar({className, ...props}) {
  return (
    <div 
    className={`${className} flex flex-row gap-0 bg-indigo-600`} 
    {...props}
    >
      <div>
        <NavLink href={'/'}>
          Home
        </NavLink>
      </div>
      <div>
        <NavLink href={'/admin'}>
          Admin Panel
        </NavLink>
      </div>
    </div>
  )
}