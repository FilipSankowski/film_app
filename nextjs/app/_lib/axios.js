import Axios from 'axios'

const axios = Axios.create({
    baseURL: `${process.env.NEXT_PUBLIC_BACKEND_URL}/api`,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'x-www-form-urlencoded'
    },
    withCredentials: true,
})

export default axios
