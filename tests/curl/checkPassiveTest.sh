gq http://localhost:8000/graphql \
     -q 'mutation { checkUser(hash: "bf868c5d0d2718a901a958738e18e0eb", passive: true) {success responseCode} }'
