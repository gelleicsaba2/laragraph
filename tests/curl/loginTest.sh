gq http://localhost:8000/graphql \
     -q 'mutation { loginUser(name: "admin", pass: "qq") {success hash fullname responseCode expire} }'
