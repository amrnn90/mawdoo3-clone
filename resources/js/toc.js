import ResizeSensor from './resize-sensor';
import tocbot from 'tocbot';
import StickySidebar from 'sticky-sidebar';

window.ResizeSensor = ResizeSensor;

let sidebar;

export default {
    onEnter: function () {

        // The new Container is ready and attached to the DOM.
        if (document.querySelector('.tocbot')) {
            const content = document.querySelector('.post__content');
            const els = content.querySelectorAll('h1, h2, h3');
            if (els.length < 3) {
                document.querySelector('.post__toc').style.display = 'none';
                return;
            }
            Array.prototype.forEach.call(els, (el) => {
                if (!el.id) {
                    let str = el.innerText.replace(/\s+/, '_');
                    let tempStr = str;
                    let suffix = 0;
    
                    while (document.getElementById(tempStr)) {
                        suffix += 1;
                        tempStr = str + '_' + suffix;
                    }
    
                    el.id = tempStr;
                }
            });
    
            tocbot.init({
                // Where to render the table of contents.
                tocSelector: '.tocbot',
                // Where to grab the headings to build the table of contents.
                contentSelector: '.post__content',
                // Which headings to grab inside of the contentSelector element.
                headingSelector: 'h1, h2, h3',
    
                // positionFixedSelector: '.tocbot',
    
            });
    
    
            sidebar = new StickySidebar('.tocbot', {topSpacing: 100});
        }
    },
    onLeave: function () {

        // A new Transition toward a new page has just started.
        if (sidebar && sidebar.destroy) {
            sidebar.destroy();
        }
    }
};