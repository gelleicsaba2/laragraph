curl \
 -H 'content-type: application/json' \
 -X POST http://127.0.0.1:8000/graphql \
 --data '{ "query": "{ hello }" }' \
   | lynx --dump -stdin
