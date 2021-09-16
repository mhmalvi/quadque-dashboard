export default function FileValidation(filename) {
    let allowedExtensions = ["png", "jpg", "jpeg"];

    return allowedExtensions.includes(filename.split(".").pop());
}
