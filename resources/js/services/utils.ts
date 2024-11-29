export const dateTimeText = (_date: Date) => {
    const mm = _date.getMonth() + 1; // getMonth() is zero-based
    const dd = _date.getDate();
    const hh = _date.getHours();
    const nn = _date.getMinutes();
    const ss = _date.getSeconds();
    return `${_date.getFullYear()}-${mm}-${dd} ${hh}:${nn}:${ss}`
};

export const addFromTemplate = (place: HTMLElement, templ: HTMLTemplateElement, item: any) => {
    const clone = templ.cloneNode(true) as HTMLElement
    for (let key in item) {
        const value = item[key]
        clone.innerHTML = clone.innerHTML.replaceAll('${'+key+'}', value)
    }
    const fragment = document.importNode((clone as HTMLTemplateElement).content, true)
    place.appendChild(fragment)
}
export const WEEKDAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
