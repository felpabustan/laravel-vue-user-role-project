import * as _ from "lodash";
import axios from "axios";
export default class Form {
    constructor(data) {
        _.extend(this, data);
        this.rawData = _.cloneDeep(data);
        this.errors = {};
    }

    getErrors(name) {
        return this.errors[name] ? this.errors[name] : [];
    }

    sendForm(url, method) {
        return new Promise((resolve, reject) => {
            axios
                .request({
                    url,
                    method,
                    data: this,
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;

                    reject(error);
                });
        });
    }

    clearForm() {
        _.extend(this, this.rawData);
        this.errors = {};
    }
}
