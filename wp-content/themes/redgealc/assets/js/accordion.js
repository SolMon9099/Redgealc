let items = document.querySelectorAll(".accordion-item");
items.forEach(function (t) {
	t.addEventListener("click", function (e) {
		items.forEach(function (e) {
			e !== t || e.classList.contains("open")
				? e.classList.remove("open")
				: e.classList.add("open");
		});
	});
})


let faq = document.querySelectorAll(".faq-item");
faq.forEach(function (t) {
	t.addEventListener("click", function (e) {
		faq.forEach(function (e) {
			e !== t || e.classList.contains("open")
				? e.classList.remove("open")
				: e.classList.add("open");
		});
	});
});