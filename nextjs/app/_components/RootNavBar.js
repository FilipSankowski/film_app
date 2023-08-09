import NavLink from "./NavLink";

export default function RootNavBar({className, ...props}) {
  return (
    <div 
    className={`${className} flex flex-row gap-0 bg-teal-500`} 
    {...props}
    >
      <div>
        <NavLink active={true} href={'/'}>
          Home
        </NavLink>
      </div>
      <div>
        <NavLink active={true} href={'/admin'}>
          Admin Panel
        </NavLink>
      </div>
    </div>
  )
}