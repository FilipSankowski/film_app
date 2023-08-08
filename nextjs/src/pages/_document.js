import Document, { Html, Head, Main, NextScript } from 'next/document'

class MyDocument extends Document {
    static async getInitialProps(ctx) {
        const initialProps = await Document.getInitialProps(ctx)
        return { ...initialProps }
    }

    render() {
        return (
            <Html>
                <Head>
                    <link
                        href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"
                        rel="stylesheet"
                    />
                </Head>
                <body className="antialiased">
                    <Main />
                    <NextScript />
                </body>
            </Html>
        )
    }
}

if (process.env.NEXT_HANDLE_SHUTDOWN_MANUALLY) {
    process.on('SIGTERM', () => {
      console.log('Received SIGTERM: ', 'cleaning up');
      process.exit(0);
    });
    process.on('SIGINT', () => {
      console.log('Received SIGINT: ', 'cleaning up');
      process.exit(0);
    });
}

export default MyDocument
