const userName = document.getElementById("nombreEstudiante");
const userApe = document.getElementById("apellidos");
const nombreCurso = document.getElementById("nombreCurso");
const nombreMaestro = document.getElementById("nombreMaestro");
const fecha = document.getElementById("fecha");
const submitBtn = document.getElementById("submitBtn");
const idCurso = $("#idCurso").val();

const { PDFDocument, rgb, degrees } = PDFLib;


const capitalize = (str, lower = false) =>
    (lower ? str.toLowerCase() : str).replace(/(?:^|\s|["'([{])+\S/g, (match) =>
        match.toUpperCase()
    );

submitBtn.addEventListener("click", () => {
    const val = capitalize(userName.value);
    const valAp = capitalize(userApe.value);
    const val2 = capitalize(nombreCurso.value);
    const val3 = capitalize(nombreMaestro.value);
    const val4 = capitalize(fecha.value);

    //check if the text is empty or not
    if (val.trim() !== "" && userName.checkValidity()) {
        generatePDF(val, valAp, val2, val3, val4);
    } else {
        userName.reportValidity();
    }
});

const generatePDF = async(name, apellidos, nameCurso, nameMaestro, pFecha) => {
    const existingPdfBytes = await fetch("certificado.pdf").then((res) =>
        res.arrayBuffer()
    );

    // Load a PDFDocument from the existing PDF bytes
    const pdfDoc = await PDFDocument.load(existingPdfBytes);
    pdfDoc.registerFontkit(fontkit);

    // Get the first page of the document
    const pages = pdfDoc.getPages();
    const firstPage = pages[0];

    // Draw a string of text diagonally across the first page
    firstPage.drawText(name, {
        x: 250,
        y: 400,
        size: 45,
        // font: BrushScriptMTCursiva,
        color: rgb(1, 1, 1),
    });
    firstPage.drawText(apellidos, {
        x: 250,
        y: 340,
        size: 45,
        // font: BrushScriptMTCursiva,
        color: rgb(1, 1, 1),
    });
    firstPage.drawText(nameCurso, {
        x: 50,
        y: 225,
        size: 30,
        // font: BrushScriptMTCursiva,
        color: rgb(1, 1, 1),
    });
    firstPage.drawText(nameMaestro, {
        x: 560,
        y: 115,
        size: 15,
        // font: BrushScriptMTCursiva,
        color: rgb(1, 1, 1),
    });
    firstPage.drawText(pFecha, {
        x: 370,
        y: 25,
        size: 20,
        // font: BrushScriptMTCursiva,
        color: rgb(1, 1, 1),
    });

    // Serialize the PDFDocument to bytes (a Uint8Array)
    const pdfBytes = await pdfDoc.save();

    var file = new File(
        [pdfBytes],
        "Certificado " + idCurso + ".pdf", {
            type: "application/pdf;charset=utf-8",
        }
    );
    saveAs(file);
};