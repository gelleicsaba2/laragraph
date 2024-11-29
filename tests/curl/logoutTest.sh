gq http://localhost:8000/graphql \
     -q 'mutation { logoutUser(name: "admin", hash: "1432dd132a09637cb1fcdc0507eef5b9") {success responseCode} }'
