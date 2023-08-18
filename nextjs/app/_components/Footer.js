export default function Footer({className, ...props}) {
  return (
    <div 
    className={`${className} bg-indigo-600 text-white p-4`} 
    {...props}
    >
      <p>
        Autor Strony: <br />
        Filip Sankowski
      </p>
    </div>
  )
}