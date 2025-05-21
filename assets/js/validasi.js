function angka(evt) {
  const charCode = evt.which || evt.keyCode
  return (charCode >= 48 && charCode <= 57) || charCode === 8
}

function huruf(evt) {
  const charCode = evt.which || evt.keyCode
  return (
    (charCode >= 65 && charCode <= 90) ||
    (charCode >= 97 && charCode <= 122) ||
    charCode === 8
  )
}
