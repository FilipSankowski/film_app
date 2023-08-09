import Footer from './_components/Footer'
import RootNavBar from './_components/RootNavBar'
import './globals.css'

export default function RootLayout({children}) {
  return (
    <html>
      <body>
        <div className='grid grid-cols-1 grid-flow-row gap-0'>
          <div>
            <RootNavBar />
          </div>
          
          <div>
            {children}
          </div>

          <div>
            <Footer>footer</Footer>
          </div>
        </div>
      </body>
    </html>
  )
}