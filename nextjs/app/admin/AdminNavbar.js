import Dropdown from "@/_components/Dropdown";
import DropdownLink from "@/_components/DropdownLink";

export default function AdminNavbar({className = '', ...props}) {
  return (
    <div 
    className={`${className} flex flex-col gap-0 bg-gray-500 flex-1`} 
    {...props}
    >
      <Dropdown header={'Wyświetl dane'}>
        <DropdownLink href={'#'}>Użytkownicy</DropdownLink>
        <DropdownLink href={'#'}>Wideo</DropdownLink>
        <DropdownLink href={'#'}>Tagi</DropdownLink>
        <DropdownLink href={'#'}>Komentarze</DropdownLink>
      </Dropdown>
      <Dropdown header={'Modyfikuj dane'}>
        <DropdownLink href={'#'}>Użytkownicy</DropdownLink>
        <DropdownLink href={'#'}>Wideo</DropdownLink>
        <DropdownLink href={'#'}>Tagi</DropdownLink>
        <DropdownLink href={'#'}>Komentarze</DropdownLink>
      </Dropdown>
    </div>
  )
}