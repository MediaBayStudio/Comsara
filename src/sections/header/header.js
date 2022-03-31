;
(function() {
  const scrollUpBtn = q('.scroll-up');
  const hdrClone = hdr.cloneNode(true);
  const hdrParent = hdr.parentElement;
  const stickyThreshold = hdr.getBoundingClientRect().bottom + scrollY;
  const stickyClassName = 'sticky';
  const stickyHiddenClassName = stickyClassName + '-hidden';
  let lastScrollY = scrollY;
  let classListAction = 'remove';

  hdrClone.classList.add('clone');

  const stickyHeader = function() {
    if (!hdr.classList.contains(stickyClassName) && scrollY >= stickyThreshold) {
      hdrParent.appendChild(hdrParent.replaceChild(hdrClone, hdr));
      hdr.classList.add(stickyClassName, stickyHiddenClassName);

      window.removeEventListener('scroll', stickyHeader);
      window.addEventListener('scroll', unstickyHeader);
    }
    scrollUpBtn.classList.toggle('hide', scrollY < 1000);
    lastScrollY = scrollY;
  }
  const unstickyHeader = function() {
    if (hdr.classList.contains(stickyClassName)) {
      if (scrollY <= stickyThreshold) {
        hdrParent.replaceChild(hdr, hdrClone);
        hdr.classList.remove(stickyClassName);

        window.removeEventListener('scroll', unstickyHeader);
        window.addEventListener('scroll', stickyHeader);
      }
      if (lastScrollY > scrollY) {
        // console.log('to bottom');
        classListAction = 'remove';
      } else if (lastScrollY < scrollY) {
        // console.log('to top');
        classListAction = 'add';
      }

      scrollUpBtn.classList.toggle('hide', scrollY < 1000);

      // if (Math.abs(lastScrollY - scrollY) > 7) {
        hdr.classList[classListAction](stickyHiddenClassName);
      // }
    }
    lastScrollY = scrollY;
  }

  stickyHeader();
  window.addEventListener('scroll', stickyHeader);
})();