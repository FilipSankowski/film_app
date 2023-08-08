export default function RootLayout({children}) {
  return (
    <html>
      <head>

      </head>
      <body>
        <div>
          <div>
            {/* Navbar */}
          </div>
          
          {children}

          <div>
            {/* Footer */}
          </div>
        </div>
      </body>
    </html>
  )
}