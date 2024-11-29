gq http://localhost:8000/graphql \
     -q 'mutation { signup(name: "csaba", fullname: "gellei.csaba", email: "xy@dd", pass: "abc") {success responseCode} }'
