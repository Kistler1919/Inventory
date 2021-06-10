class Token {
    isValid(token) {
        const payload = this.payload(token)
        if (payload) {
            return payload.iss =
                "http://inventory.test/api/v1/auth/login" ||
                "http://inventory.test/api/v1/auth/register" ? true : false
        }
        return false
    }

    payload(token) {
      const payload = token.split('.')[1]
      return this.decode(payload)
    }

    decode(payload) {
      return JSON.parse(atob(payload))
    }
}

export default Token = new Token();
