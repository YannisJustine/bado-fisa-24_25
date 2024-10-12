window.addEventListener('load', function(event) {
    let id = this.location.hash;
    if(id)
        this.document.querySelector(id.concat('-tab')).click();
    else
        this.document.querySelector('button[role="tab"]').click();
})

let ignorePopstate = false;

window.addEventListener('popstate', function(event) {
    if(ignorePopstate)
        return;
    let id = this.location.hash;
    if(id)
        this.document.querySelector(id.concat('-tab')).click();
    else
        this.document.querySelector('button[role="tab"]').click();
});

document.querySelectorAll('[role="tab"]').forEach(tab => {
    tab.addEventListener('click', function(event) {
        ignorePopstate = true;
        window.location.hash = this.id.replace('-tab', '');
        ignorePopstate = false;
    })
})

initTabs();