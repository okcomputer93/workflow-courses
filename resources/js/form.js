import axios from "axios";

class Errors {
    constructor() {
        this.errors = {};
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    any() {
        for (let i in this.errors) {
            return true;
        }
        return false;
    }

    clear(field) {
        if (field) {
            if (this.errors[field]) {
                delete this.errors[field];
                return;

                // If you're not using a preprocessor you'll have probles with this part, it will be not reactive.
                // Use Vue.delete(this.errors, field);
            }
        } else this.errors = {};
    }
}

export class Form {
    constructor(data) {
        this.originalData = data;

        Object.keys(data).forEach((field) => {
            this[field] = data[field];
        });
        this.errors = new Errors();
    }

    data() {
        return Object.keys(this.originalData).reduce((acc, field) => {
            acc[field] = this[field];
            return acc;
        }, {});
    }

    reset() {
        Object.keys(this.originalData).forEach((field) => {
            this[field] = "";
        });
        this.errors.clear();
    }

    async submit(requestType, url) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios[requestType](url, this.data());
                this.onSuccess(response.data);
                resolve(response.data);
            } catch (error) {
                this.onFail(error.response.data.errors);
                reject(error.response.data.errors);
            }
        });
    }

    onSuccess() {
       // Do something
    }

    onFail(errors) {
        this.errors.record(errors);
    }
}
