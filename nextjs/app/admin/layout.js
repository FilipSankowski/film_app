import AdminNavbar from "./AdminNavbar";

export default function AdminLayout({children}) {
  return (
    <div className={'grid grid-cols-6 grid-rows-1 gap-0'}>
      <div className={'col-span-1 bg-gray-400 flex'}>
        <AdminNavbar />
      </div>
      <div className={'col-span-5'}>
        {children}
      </div>
    </div>
  )
}