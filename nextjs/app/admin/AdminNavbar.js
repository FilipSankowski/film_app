import Dropdown from "@/_components/Dropdown";
import DropdownLink from "@/_components/DropdownLink";

export default function AdminNavbar({className = '', ...props}) {
  return (
    <div 
    className={`${className} flex flex-col gap-0 bg-gray-500 flex-1`} 
    {...props}
    >
      <Dropdown header={'Wyświetl dane'}>
        <DropdownLink href={'/admin/users'}>Użytkownicy</DropdownLink>
        <DropdownLink href={'/admin/videos'}>Wideo</DropdownLink>
        <DropdownLink href={'/admin/tags'}>Tagi</DropdownLink>
        <DropdownLink href={'/admin/comments'}>Komentarze</DropdownLink>
      </Dropdown>
      <Dropdown header={'Modyfikuj dane'}>
        <DropdownLink href={'/admin/users/form'}>Użytkownicy</DropdownLink>
        <DropdownLink href={'/admin/videos/form'}>Wideo</DropdownLink>
        <DropdownLink href={'/admin/tags/form'}>Tagi</DropdownLink>
        <DropdownLink href={'/admin/comments/form'}>Komentarze</DropdownLink>
      </Dropdown>
    </div>
  )
}