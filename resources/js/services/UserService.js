import Api from './Api'


export default class {

    static async changePassword(data) {
        let api = new Api('user')

        let changeResult = await api.post('/changePassword', data)

        return changeResult
    }

}