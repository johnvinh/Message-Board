document.querySelector('#submitButton').addEventListener('click', (e) =>
{
    e.preventDefault();
    // validate input client side before submitting
    if (document.querySelector('#name').value === '') {
        alert('Please enter a name.');
        return;
    }
    else if (document.querySelector('#message').value === '') {
        alert('Please enter a message.');
        return;
    }
    // after preventing empty input, submit form
    document.querySelector('#form').submit();
});