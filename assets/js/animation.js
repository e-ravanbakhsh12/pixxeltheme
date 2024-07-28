class MainAnimation {
  constructor() {}

  once(selector) {
    // new LenisScroll(selector);
  }

  pluginsHandler(selector) {
    // new InfinitySlider(selector);
  }

  animationsHandler(selector) {
    this.animationsArray = [];
    this.animElements = [...selector.querySelectorAll("[data-anim]")];
    this.animationsList = [
      "up",
      // "bg",
      // "fall",
      // "opacity",
      "title",
      // "vertical",
      "horizontal",
      // "width",
      // "fill",
    ];
    const mm = gsap.matchMedia();

    mm.add("(min-width: 1023.99px)", (e) => {
      this.animationsList.forEach((animation) => {
        this.animElements.forEach((el) => {
          const anim = el.dataset.anim;

          if (animation === anim && anim === "bg") {
            this.animationsArray.push(new AnimBG(el));
          }
        });
      });
    });

    this.animationsList.forEach((animation) => {
      this.animElements.forEach((el) => {
        const anim = el.dataset.anim;
        console.log(animation);
        if (animation === anim && anim === "up") {
          this.animationsArray.push(new AnimUp(el));
        }

        if (animation === anim && anim === "title") {
          this.animationsArray.push(new AnimTitle(el));
        }

        if (animation === anim && anim === "horizontal") {
          this.animationsArray.push(new AnimHorizontal(el));
        }

        if (animation === anim && anim === "vertical") {
          this.animationsArray.push(new AnimVertical(el));
        }

        if (animation === anim && anim === "fill") {
          this.animationsArray.push(new AnimFill(el));
        }

        if (animation === anim && anim === "fall") {
          this.animationsArray.push(new AnimFall(el));
        }
      });
    });
  }
}

class Animations {
  constructor({ element }) {
    this.element = element;
    this.dataset = element.dataset;
    this.scope = gsap.utils.selector(this.element);
    this.targets = this.dataset.targets
      ? this.dataset.targets.includes(",")
        ? this.dataset.targets.split(",").map((el) => this.scope(el))
        : this.scope(this.dataset.targets)
      : this.element;

    this.split = this.dataset.split
      ? this.SplitHandler(
          this.targets,
          this.dataset.split,
          this.dataset.depth || 2
        )
      : false;
    this.scrub = this.dataset.scrub === "" ? true : false;

    if (this.dataset.split) this.targets = this.scope(`.${this.dataset.split}`);
    this.prepare();

    if (document.querySelector(".loader")) {
      window.addEventListener("loaderFinished", (e) => {
        this.scrollTrigger();
      });
    } else {
      if (document.querySelector("header").classList.contains("menu-open")) {
        setTimeout(() => {
          this.scrollTrigger();
        }, 500);
      } else {
        this.scrollTrigger();
      }
    }
  }
  SplitHandler(el, type, depth = 1) {
    new SplitText(el, {
      type: type,
      linesClass: type,
      charsClass: type,
      wordsClass: type,
      reduceWhiteSpace: false,
    });
    if (depth > 1) {
      new SplitText(el, {
        type: "lines",
        linesClass: "split-wrapper",
        reduceWhiteSpace: false,
      });
    }
  }

  scrollTrigger() {
    ScrollTrigger.create({
      trigger: this.element,
      // markers: this.scrub && true,s
      start: this.dataset.start ? this.dataset.start : `top 100%`,
      end: this.dataset.end ? this.dataset.end : `bottom 0`,
      scrub: this.scrub && 0,
      animation: this.scrub && this.onEnter(),
      onEnter: () => !this.scrub && this.onEnter(),
      onEnterBack: () => !this.scrub && this.onEnterBack(),
    });

    ScrollTrigger.create({
      trigger: this.element,
      start: `top ${this.dataset.backStart ?? "110%"}`,
      end: `bottom ${this.dataset.backEnd ?? "-10%"}`,
      onLeave: () => !this.scrub && this.onLeave(),
      onLeaveBack: () => !this.scrub && this.prepare(),
    });
  }

  onEnter() {}

  onEnterBack() {
    //   gsap.to(this.targets, {
    //     opacity: 1,
    //     y: 0,
    //     duration: 1,
    //     stagger: -0.08,
    //     delay: 0.05,
    //     ease: 'power3.out',
    //     overwrite: true,
    //   });
  }

  onLeave() {
    //   gsap.set(this.targets, {
    //     opacity: 0,
    //     y: -30,
    //     x: 0,
    //     duration: 1,
    //     stagger: 0.08,
    //     ease: 'power3.out',
    //     overwrite: true,
    //   });
  }

  onLeaveBack() {}
}

class AnimTitle extends Animations {
  constructor(element) {
    super({
      element,
    });
  }

  prepare() {
    gsap.set(this.targets, {
      opacity: 0,
      y: this.dataset.y || "100%",
      overwrite: true,
    });
  }

  onEnter() {
    gsap.to(this.targets, {
      y: 0,
      opacity: 1,
      delay: this.dataset.delay,
      duration: this.dataset.durr || 1,
      stagger: this.dataset.stagger || 0.1,
      ease: "power3.out",
    });
  }
}

class AnimUp extends Animations {
  constructor(element) {
    super({
      element,
    });
  }

  prepare() {
    gsap.set(this.targets, {
      opacity: 0,
      y: this.dataset.y || "50",
      overwrite: true,
    });
  }

  onEnter() {
    gsap.to(this.targets, {
      y: 0,
      opacity: 1,
      delay: this.dataset.delay,
      duration: this.dataset.durr || 1,
      stagger: this.dataset.stagger || 0.09,
      ease: "power3.out",
    });
  }
}

class AnimBG extends Animations {
  constructor(element) {
    super({
      element,
    });
  }

  prepare() {
    gsap.set(this.targets, {
      width: "100vw",
      overwrite: true,
    });
  }

  onEnter() {
    return gsap.to(this.targets, {
      width: "100%",
      delay: this.dataset.delay,
      duration: this.dataset.durr || 0.8,
      stagger: this.dataset.stagger || 0.03,
      overwrite: true,
      ease: "power2.out",
    });
  }
}

class AnimHorizontal extends Animations {
  constructor(element) {
    super({
      element,
    });
  }

  prepare() {
    gsap.set(this.targets, {
      opacity: this.scrub ? 1 : 0,
      x: this.dataset.x || -50,
      overwrite: true,
    });
  }

  onEnter() {
    return gsap.to(this.targets, {
      opacity: 1,
      x: this.dataset.to || 0,
      delay: this.dataset.delay,
      duration: this.scrub ? 2 : 1,
      stagger: window.innerWidth < 1024 ? 0.01 : this.dataset.stagger || 0.1,
      ease: this.scrub ? "none" : "power3.out",
    });
  }
}

class AnimVertical extends Animations {
  constructor(element) {
    super({
      element,
    });
  }

  prepare() {
    gsap.set(this.targets, {
      opacity: this.scrub ? 1 : 0,
      y: this.dataset.y || -50,
      overwrite: true,
    });
  }

  onEnter() {
    return gsap.to(this.targets, {
      opacity: 1,
      y: this.dataset.to || 0,
      delay: this.dataset.delay,
      duration: this.scrub ? 2 : 1,
      stagger: window.innerWidth < 1024 ? 0.01 : this.dataset.stagger || 0.1,
      ease: this.scrub ? "none" : "power3.out",
    });
  }
}

class AnimFill extends Animations {
  constructor(element) {
    super({
      element,
    });
  }

  prepare() {}

  onEnter() {
    return gsap.to(this.targets, {
      color: "#FFD22E",
      delay: this.dataset.delay,
      duration: this.dataset.durr || 0.8,
      stagger: this.dataset.stagger || 0.03,
      overwrite: true,
      ease: "power2.out",
    });
  }
}

class AnimFall extends Animations {
  constructor(element) {
    super({
      element,
    });
  }

  prepare() {
    gsap.set(this.targets, {
      y: "-200%",
    });
  }

  onEnter() {
    return gsap.to(this.targets, {
      y: 0,
      delay: this.dataset.delay,
      duration: this.dataset.durr || 1.2,
      stagger: this.dataset.stagger || 0.03,
      overwrite: true,
      ease: "bounce.out",
    });
  }
}

function HorizontalLoop(items, config) {
  items = gsap.utils.toArray(items);
  config = config || {};

  let tl = gsap.timeline({
      repeat: config.repeat,
      paused: config.paused,
      defaults: { ease: "none" },
      onReverseComplete: () => tl.totalTime(tl.rawTime() + tl.duration() * 100),
    }),
    length = items.length,
    startX = items[0].offsetLeft,
    times = [],
    widths = [],
    xPercents = [],
    curIndex = 0,
    pixelsPerSecond = (config.speed || 1) * 100,
    snap = config.snap === false ? (v) => v : gsap.utils.snap(config.snap || 1), // some browsers shift by a pixel to accommodate flex layouts, so for example if width is 20% the first element's width might be 242px, and the next 243px, alternating back and forth. So we snap to 5 percentage points to make things look more natural
    totalWidth,
    curX,
    distanceToStart,
    distanceToLoop,
    item,
    i;

  gsap.set(items, {
    // convert "x" to "xPercent" to make things responsive, and populate the widths/xPercents Arrays to make lookups faster.
    xPercent: (i, el) => {
      let w = (widths[i] = parseFloat(gsap.getProperty(el, "width", "px")));
      xPercents[i] = snap(
        (parseFloat(gsap.getProperty(el, "x", "px")) / w) * 100 +
          gsap.getProperty(el, "xPercent")
      );
      return xPercents[i];
    },
  });

  gsap.set(items, { x: 0 });
  totalWidth =
    items[length - 1].offsetLeft +
    (xPercents[length - 1] / 100) * widths[length - 1] -
    startX +
    items[length - 1].offsetWidth *
      gsap.getProperty(items[length - 1], "scaleX") +
    (parseFloat(config.paddingRight) || 0);
  for (i = 0; i < length; i++) {
    item = items[i];
    curX = (xPercents[i] / 100) * widths[i];
    distanceToStart = item.offsetLeft + curX - startX;
    distanceToLoop =
      distanceToStart + widths[i] * gsap.getProperty(item, "scaleX");
    tl.to(
      item,
      {
        xPercent: snap(((curX - distanceToLoop) / widths[i]) * 100),
        duration: distanceToLoop / pixelsPerSecond,
      },
      0
    )
      .fromTo(
        item,
        {
          xPercent: snap(
            ((curX - distanceToLoop + totalWidth) / widths[i]) * 100
          ),
        },
        {
          xPercent: xPercents[i],
          duration:
            (curX - distanceToLoop + totalWidth - curX) / pixelsPerSecond,
          immediateRender: false,
        },
        distanceToLoop / pixelsPerSecond
      )
      .add("label" + i, distanceToStart / pixelsPerSecond);
    times[i] = distanceToStart / pixelsPerSecond;
  }

  function toIndex(index, vars) {
    vars = vars || {};
    Math.abs(index - curIndex) > length / 2 &&
      (index += index > curIndex ? -length : length); // always go in the shortest direction
    let newIndex = gsap.utils.wrap(0, length, index),
      time = times[newIndex];
    if (time > tl.time() !== index > curIndex) {
      // if we're wrapping the timeline's playhead, make the proper adjustments
      vars.modifiers = { time: gsap.utils.wrap(0, tl.duration()) };
      time += tl.duration() * (index > curIndex ? 1 : -1);
    }
    curIndex = newIndex;
    vars.overwrite = true;
    return tl.tweenTo(time, vars);
  }

  tl.next = (vars) => toIndex(curIndex + 1, vars);
  tl.previous = (vars) => toIndex(curIndex - 1, vars);
  tl.current = () => curIndex;
  tl.toIndex = (index, vars) => toIndex(index, vars);
  tl.times = times;
  tl.progress(1, true).progress(0, true); // pre-render for performance
  if (config.reversed) {
    tl.vars.onReverseComplete();
    tl.reverse();
  }
  return tl;
}

class Header {
  constructor() {
    this.header = document.querySelector("header");
    if (!this.header) return;
    this.controller();
  }

  controller() {
    this.scrollHandler();
  }

  scrollHandler() {
    let height = this.header.offsetHeight;
    let self = this;
    let to;

    window.onscroll = function (e) {
      if (this.oldScroll > this.scrollY) {
        self.header.classList.add("up");
      } else {
        self.header.classList.remove("up");
      }

      if (this.scrollY > height) {
        self.header.classList.add("scroll");

        if (!self.header.classList.contains("anim")) {
          to = setTimeout(() => {
            self.header.classList.add("anim");
          }, 100);
        }
      }

      if (this.scrollY === 0) {
        clearTimeout(to);
        self.header.classList.remove("scroll");
        self.header.classList.remove("up");

        setTimeout(() => {
          self.header.classList.remove("anim");
        }, 250);
      }

      this.oldScroll = this.scrollY;
    };
  }
}

window.addEventListener("DOMContentLoaded", (e) => {
  gsap.registerPlugin(ScrollTrigger, ScrollSmoother, SplitText);

  // create the smooth scroller FIRST!
  const smoother = ScrollSmoother.create({
    content: ".smooth-scroll",
    smooth: 2,
    normalizeScroll: true,
    ignoreMobileResize: true,
    effects: true,
    //preventDefault: true,
    //ease: 'power4.out',
    //smoothTouch: 0.1,
  });
  // create
  let mm = gsap.matchMedia();

  mm.add("(max-width: 726px)", function () {
    gsap.to(".cover-down", {
      y: 200,
      scale: 0.8,
      scrollTrigger: {
        trigger: ".cover-down",
        start: "bottom 50%",
        end: "bottom top",
        scrub: 0.8,
      },
    });
  });
  mm.add("(min-width: 727px)", function () {
    gsap.to(".cover-down", {
      y: 400,
      scale: 0.8,
      scrollTrigger: {
        trigger: ".cover-down",
        start: "bottom 80%",
        end: "bottom top",
        scrub: 0.8,
      },
    });
  });

  let header = new Header();
  let animation = new MainAnimation();

  // animation.once();
  animation.pluginsHandler(document);
  document.fonts.ready.then(() => {
    animation.animationsHandler(document);
  });
});
window.addEventListener("queryLoaded", (e) => {
  console.log(e);
  let animation = new MainAnimation();

  animation.animationsHandler(e.detail.container);
  animation.pluginsHandler(e.detail.container);
});
