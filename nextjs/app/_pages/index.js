import Head from 'next/head'
import Link from 'next/link'
import { useAuth } from '@/_hooks/auth'

export default function Home() {
    const { user } = useAuth({ middleware: 'guest' })

    return (
        <>  
            <div>test</div>
        </>
    )
}
