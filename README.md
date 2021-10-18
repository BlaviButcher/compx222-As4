Mozzila has a bug within content-editable containers where the cursor doesn't sit where it is meant to.
Other browsers don't have the same issue

1. After change on an empty container, the cursors moves up
2. On focus on a fresh page, the cursor starts to the left
3. On new page with container having content the cursor starts one space to far to the right visually, but computationally it is in the correct place
