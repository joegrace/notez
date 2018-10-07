import axios from 'axios'
import Alert from './Alert'

export default class {
    
    constructor(endpointPrefix) {
        // Everything is in /api/
        this._prefix = '/api/' + endpointPrefix
        this._comErrorTitle = 'Fatal Error!'
        this._comerrorMessage = 'We\'re sorry, we were not able to perform that request. Please try again later.'
    }
    
    async get(endpoint) {
        if (endpoint == undefined)
            endpoint = ''
        
        let result;
        try {
            result = await axios.get(this._prefix + endpoint)
        }
        catch (e) {
            console.log('Something happened on get: ' + e)
            this._sendStandardComAlert()
        }
        
        return result.data;
    }
    
    async post(endpoint, data) {
        let result;
        
        try {
            result = await axios.post(this._prefix + endpoint, data)
        }
        catch (e) {
            console.log('Something happened on post: ' + e)
            this._sendStandardComAlert()
        }
        
        return result.data;
    }
    
    async delete(endpoint, data) {
        let result;
        
        try {
            result = await axios.delete(this._prefix + endpoint, data)
        }
        catch (e) {
            console.log('Something happened on delete: ' + e)
            this._sendStandardComAlert()
        }
        
        return result.data;
    }

    _sendStandardComAlert() {
        Alert.alert(this._comErrorTitle, this._comerrorMessage)
    }
    
}