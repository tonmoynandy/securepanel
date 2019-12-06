let hostElement = document.querySelector('.custom-tab');
var tabObj = this;
if (hostElement) {

    if (hostElement.querySelector('.tab-menu') && hostElement.querySelector('.tab-content')) {
    
        var tabItems = hostElement.querySelector('.tab-menu').children;
        var tabContainerDom = hostElement.querySelector('.tab-content');
        let tabContent = tabContainerDom.innerHTML;
        let tabContentDom = document.createElement('div');
        tabContentDom.innerHTML = tabContent;
        tabContainerDom.innerHTML = '';
        var activeItem = 0;
        if (hostElement.querySelector('.active')) {
            activeItem = Array.prototype.indexOf.call(tabItems, hostElement.querySelector('.active'));
        }
        tabItems[activeItem].classList.add('active');
        tabContainerDom.innerHTML = tabContentDom.children.item(activeItem).outerHTML;
    
            Array.from(tabItems).forEach((element, index) => {
                if (hostElement.classList.value.indexOf('vertical') == -1) {
                    element.style.width = (100/tabItems.length)+'%'; 
                }
                if (!element.getAttribute('id')) {
                    element.setAttribute('id', 'tab-' + index);
                }
                element.addEventListener('click', function (e) {
                    hostElement.querySelector('.active').classList.remove('active');
                    tabContainerDom.innerHTML = '';
                    if (e.target.parentElement == hostElement.querySelector('.tab-menu')) {
                        e.target.classList.add('active');
                    } else {
                        e.target.parentElement.classList.add('active');
                    }
                    let activeMenu = Array.prototype.indexOf.call(tabItems, hostElement.querySelector('.active'));
                    tabContainerDom.innerHTML = tabContentDom.children.item(activeMenu).outerHTML;
    
                    
                });
    
            });
    } else {
        console.error("'.tab-menu' or '.tab-content' is missing");
    }
}
