
@if ($direction === 'asc')
    <svg fill="{{$color}}" width="{{$size}}" height="{{$size}}" viewBox="0 0 8 8" xmlns="http://www.w3.org/2000/svg" transform="rotate(180)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 0v6h-2l2.5 2 2.5-2h-2v-6h-1zm2 0v1h4v-1h-4zm0 2v1h3v-1h-3zm0 2v1h2v-1h-2z"></path> </g></svg>
@elseif ($direction === 'desc')
    <svg fill="{{$color}}" width="{{$size}}" height="{{$size}}" viewBox="0 0 8 8" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 0v6h-2l2.5 2 2.5-2h-2v-6h-1zm2 0v1h4v-1h-4zm0 2v1h3v-1h-3zm0 2v1h2v-1h-2z"></path> </g></svg>
@endif
