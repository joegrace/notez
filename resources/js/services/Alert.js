export default class {


    static alert(title, msg) {
        // Set the alert to the root vue component and emit
        // the open modal bootstrap event
        VueRoot.alertModalType = 'alert'
        VueRoot.alertModalMessage = msg
        VueRoot.alertModalTitle = title || 'Alert'
        VueRoot.alertModalHeaderVariant = 'danger'

        VueRoot.$emit('bv::show::modal','alertModal')
    }

    static async confirm(title, msg) {
        // Eww.... I really wish I didn't have to create a new promise here,
        // but since vm.$watch takes a callback in it's second parameter, I
        // was not sure how to return a value from the async function from
        // inside an arraw function. Still looking into this, cause this has
        // some code smell.

        return new Promise((resolve, reject) => {
            VueRoot.alertModalType = 'confirm'
            VueRoot.alertModalMessage = msg
            VueRoot.alertModalTitle = title || 'Confirm'
            VueRoot.$emit('bv::show::modal','alertModal')
    
            VueRoot.$watch('alertModalConfirmLastValue', (val) => {
                resolve(val)
            })
        })
    }
    


}