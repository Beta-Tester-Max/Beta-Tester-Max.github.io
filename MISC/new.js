import { useState, useRef } from "react";
import { Button } from "@/components/ui/button";
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem } from "@/components/ui/dropdown-menu";
import { Switch } from "@/components/ui/switch";
import { Label } from "@/components/ui/label";

export default function SimpleWordEditor() {
  const editorRef = useRef(null);
  const [isDarkMode, setIsDarkMode] = useState(false);

  const formatText = (command, value = null) => {
    document.execCommand(command, false, value);
    editorRef.current.focus();
  };

  const saveContentToFile = () => {
    const content = editorRef.current.innerHTML;
    const blob = new Blob([content], { type: "text/html" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "document.html";
    link.click();
  };

  return (
    <div className={`max-w-4xl mx-auto mt-10 p-4 rounded-2xl shadow-md transition-colors duration-300 ${isDarkMode ? 'bg-gray-900 text-white' : 'bg-white text-black'}`}>
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-2xl font-bold">Simple Word Editor</h1>
        <div className="flex items-center gap-2">
          <Label htmlFor="dark-mode">Dark Mode</Label>
          <Switch id="dark-mode" checked={isDarkMode} onCheckedChange={setIsDarkMode} />
        </div>
      </div>
      <div className="flex flex-wrap gap-2 mb-4">
        <Button onClick={() => formatText("bold")} variant="outline">Bold</Button>
        <Button onClick={() => formatText("italic")} variant="outline">Italic</Button>
        <Button onClick={() => formatText("underline")} variant="outline">Underline</Button>
        <Button onClick={() => formatText("justifyLeft")} variant="outline">Left</Button>
        <Button onClick={() => formatText("justifyCenter")} variant="outline">Center</Button>
        <Button onClick={() => formatText("justifyRight")} variant="outline">Right</Button>
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="outline">Font Size</Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent>
            {[1, 2, 3, 4, 5, 6, 7].map((size) => (
              <DropdownMenuItem
                key={size}
                onClick={() => formatText("fontSize", size)}
              >
                Size {size}
              </DropdownMenuItem>
            ))}
          </DropdownMenuContent>
        </DropdownMenu>
        <Button onClick={saveContentToFile} variant="default">Save</Button>
      </div>
      <div
        ref={editorRef}
        contentEditable
        className={`min-h-[300px] border p-4 rounded-md focus:outline-none ${isDarkMode ? 'bg-gray-800 text-white' : 'bg-white text-black'}`}
        suppressContentEditableWarning
      >
        Start typing here...
      </div>
    </div>
  );
}
