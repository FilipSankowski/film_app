export default function Footer({children, className, ...props}) {
  return (
    <div 
    className={`${className} bg-teal-700`} 
    {...props}
    >
      {children}
    </div>
  )
}