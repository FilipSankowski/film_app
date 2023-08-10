export default function Select({children, className, ...props}) {
  return (
    <select
    className={`${className} rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50`}
    {...props}
    >
      {children}
    </select>
  )
}