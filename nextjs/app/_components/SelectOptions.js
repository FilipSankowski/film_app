export default function SelectOptions({options, className, ...props}) {
  const data = options.map((option) => {
    return (
      <option
        key={option.value}
        className={'relative cursor-default select-none py-2 pl-3 pr-9'}
        value={option.value}
        {...props}
      >
        {option.name}
      </option>
    )
  })

  return (
    <>{data}</>
  )
}