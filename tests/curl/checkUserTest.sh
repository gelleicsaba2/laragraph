gq http://localhost:8000/graphql \
     -q 'mutation { checkUser(hash: "2e9d1943019c663a6f5bf31657119bdb", passive: false) {success responseCode} }'
