function setDarkMode(bool) {
    if(bool) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('dark-mode', true);
    }
    else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('dark-mode', false);
    }
}

const radioButtons = document.querySelectorAll('input[name="theme"]');

if (radioButtons.length > 0) {
    radioButtons.forEach((radioButton, i) => {
        if ((localStorage.getItem('dark-mode') === 'true' && radioButton.value === "dark")) {
            radioButton.checked = true;
        } else if((localStorage.getItem('dark-mode') === 'false' && radioButton.value === "light")) {
            radioButton.checked = true;
        }
        else if(!('dark-mode' in localStorage) && radioButton.value === "system") {
            radioButton.checked = true;
        }


        radioButton.addEventListener('change', () => {
            if (radioButton.value === "dark") 
                setDarkMode(true)
            else if (radioButton.value === "light") 
                setDarkMode(false)
            else {
                if(window.matchMedia('(prefers-color-scheme: dark)').matches)
                    setDarkMode(true)  
                else 
                    setDarkMode(false)
            }
        });
    });
}