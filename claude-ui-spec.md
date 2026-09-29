# Claude AI Design System Specification (`claude-ui-spec.md`)
> **Target Audience:** AI Agent / UI Generator / Frontend Developers  
> **Status:** Active Reference Specification  
> **Aesthetic Archetype:** *Editorial Bookish & Warm Intellectual Minimalism*  
> **Reference:** [claude.ai](https://claude.ai) interface & design language

---

## 1. Machine-Readable Token Manifest (JSON Schema)

```json
{
  "$schema": "https://json-schema.org/draft/2020-12/schema",
  "name": "claude-ui-design-system",
  "version": "1.0.0",
  "theme": {
    "vibe": "editorial-bookish",
    "modes": ["light", "dark"],
    "colors": {
      "light": {
        "bg": {
          "canvas": "#FAF9F5",
          "surface": "#F3F1EC",
          "surface_elevated": "#FFFFFF",
          "subtle": "#ECEAE3"
        },
        "text": {
          "primary": "#1E1E1E",
          "secondary": "#68655E",
          "tertiary": "#8F8B82",
          "inverse": "#FFFFFF"
        },
        "border": {
          "default": "#E5E2D9",
          "subtle": "#ECE9E2",
          "focus": "#D97757"
        },
        "accent": {
          "primary": "#D97757",
          "hover": "#C96646",
          "subtle": "#F7ECE6",
          "text": "#FFFFFF"
        }
      },
      "dark": {
        "bg": {
          "canvas": "#1B1A17",
          "surface": "#262521",
          "surface_elevated": "#2F2D28",
          "subtle": "#36342E"
        },
        "text": {
          "primary": "#ECEAE5",
          "secondary": "#AAA69D",
          "tertiary": "#77736A",
          "inverse": "#1B1A17"
        },
        "border": {
          "default": "#383630",
          "subtle": "#2D2B26",
          "focus": "#E07A5F"
        },
        "accent": {
          "primary": "#E07A5F",
          "hover": "#EB8E75",
          "subtle": "#3B2A24",
          "text": "#FFFFFF"
        }
      }
    },
    "typography": {
      "font_family": {
        "heading": "Lora, Newsreader, 'Source Serif 4', Georgia, serif",
        "body": "Inter, 'Plus Jakarta Sans', Figtree, -apple-system, sans-serif",
        "mono": "'JetBrains Mono', 'Fira Code', ui-monospace, monospace"
      }
    },
    "radius": {
      "sm": "6px",
      "md": "10px",
      "lg": "16px",
      "xl": "24px",
      "full": "9999px"
    },
    "shadows": {
      "card": "0 2px 8px -2px rgba(30, 26, 20, 0.06), 0 1px 3px -1px rgba(30, 26, 20, 0.04)",
      "modal": "0 16px 36px -8px rgba(30, 26, 20, 0.12), 0 4px 12px -2px rgba(30, 26, 20, 0.06)",
      "input": "0 2px 10px rgba(30, 26, 20, 0.04), 0 0 0 1px rgba(30, 26, 20, 0.06)"
    }
  }
}
```

---

## 2. Core Aesthetic Vibe & Principles

### The "Editorial Bookish" Philosophy
Claude's UI does not look like standard SaaS dashboard software or a messaging app (e.g. Slack, WhatsApp, or iMessage). Instead, it evokes the experience of **a refined literary manuscript, high-end printing, and personal thinking space**.

1. **Warm Canvas, Not Sterile White:**  
   Never use `#FFFFFF` as the main window background. Claude uses warm unbleached parchment/paper tones (`#FAF9F5`) that eliminate eye strain and feel organic.
2. **Espresso Dark Mode, Never True Black:**  
   Dark mode is never pure OLED black (`#000000`). It is a deep, warm espresso/charcoal tone (`#1B1A17` or `#1E1E1C`) that preserves the literary atmosphere.
3. **Terracotta / Burnt Sienna Signature Accent:**  
   Claude's recognizable color is warm terracotta/clay (`#D97757`), contrasting naturally with paper tones. Avoid high-saturation tech blues or neon greens.
4. **Prose-First Hierarchy:**  
   Conversations read like articles, essays, or code notebooks. Generous line-height (`1.65` - `1.75`), balanced line length (max `46rem` / `736px`), and natural typographic rhythm.
5. **Quiet Chrome:**  
   Toolbars, action buttons, and icons are minimal, featherweight, and whisper quiet. They only assert themselves when hovered or focused.

---

## 3. Typography System

### Font Pairings

| Role | Claude Native | Google Fonts Alternative (Recommended) | Fallback Stack |
| :--- | :--- | :--- | :--- |
| **Heading / Editorial Title** | *Tiempos Headline / Copernicus* | **`Lora`** or **`Newsreader`** or **`Source Serif 4`** | `Georgia, 'Times New Roman', serif` |
| **Body / Assistant Responses** | *Styrene B / Untitled Sans / Söhne* | **`Inter`** or **`Plus Jakarta Sans`** or **`Figtree`** | `-apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif` |
| **Code / Data / Monospace** | *Styrene Mono / Colophon* | **`JetBrains Mono`** or **`Fira Code`** | `'SF Mono', Menlo, Consolas, monospace` |

### Font Scale & Tracking

```css
/* Typography Scale */
--font-editorial-title: 'Lora', Georgia, serif;
--font-sans: 'Inter', system-ui, sans-serif;
--font-mono: 'JetBrains Mono', monospace;

/* Heading 1 (Welcome message / Document titles) */
font-family: var(--font-editorial-title);
font-size: clamp(2rem, 3.5vw, 2.5rem); /* 32px - 40px */
font-weight: 500;
line-height: 1.25;
letter-spacing: -0.025em;

/* Heading 2 (Section titles in markdown response) */
font-family: var(--font-editorial-title);
font-size: 1.5rem; /* 24px */
font-weight: 500;
line-height: 1.35;
letter-spacing: -0.015em;
margin-top: 1.75rem;
margin-bottom: 0.75rem;

/* Heading 3 (Sub-sections) */
font-family: var(--font-editorial-title);
font-size: 1.2rem; /* 19.2px */
font-weight: 500;
line-height: 1.4;

/* Body (Assistant responses & user messages) */
font-family: var(--font-sans);
font-size: 1rem; /* 16px */
font-weight: 400;
line-height: 1.72;
letter-spacing: -0.011em;

/* Small UI Text (Timestamp, labels, token counters) */
font-family: var(--font-sans);
font-size: 0.8125rem; /* 13px */
line-height: 1.4;
letter-spacing: 0.005em;

/* Inline & Block Code */
font-family: var(--font-mono);
font-size: 0.875rem; /* 14px */
line-height: 1.6;
```

---

## 4. Complete Color Palette (Tokens & CSS Variables)

```css
:root {
  /* ================= LIGHT MODE ================= */
  /* Canvas & Surfaces */
  --claude-bg-canvas: #FAF9F5;          /* Warm paper primary background */
  --claude-bg-surface: #F3F1EC;         /* Sidebar, cards, secondary panels */
  --claude-bg-surface-elevated: #FFFFFF;/* Modals, popovers, active inputs */
  --claude-bg-subtle: #ECEAE3;          /* Hover states on warm elements */

  /* Text & Contrast */
  --claude-text-primary: #1E1E1E;       /* Soft charcoal (never #000000) */
  --claude-text-secondary: #68655E;     /* Muted body text / subtitles */
  --claude-text-tertiary: #8F8B82;      /* Placeholders, disabled text */
  --claude-text-inverse: #FFFFFF;

  /* Borders & Dividers */
  --claude-border-default: #E5E2D9;     /* Standard subtle card/divider border */
  --claude-border-subtle: #ECE9E2;      /* Very soft internal dividers */
  --claude-border-focus: #D97757;       /* Input ring / active state */

  /* Accent & Interaction (Claude Terracotta) */
  --claude-accent-primary: #D97757;     /* Signature terracotta clay */
  --claude-accent-hover: #C96646;       /* Darker terracotta on hover */
  --claude-accent-subtle: #F7ECE6;      /* Badge background / selection tint */
  --claude-accent-text: #FFFFFF;        /* Contrast on accent */

  /* Semantic Feedback */
  --claude-error-bg: #FBEBEB;
  --claude-error-text: #B43838;
  --claude-success-bg: #EAF4EE;
  --claude-success-text: #2D7A4D;

  /* Code Syntax Blocks */
  --claude-code-bg: #222220;            /* Claude dark syntax container */
  --claude-code-text: #F3F1EC;
  --claude-code-inline-bg: #EFECE6;
  --claude-code-inline-text: #963820;

  /* Shadows */
  --claude-shadow-sm: 0 1px 2px rgba(30, 26, 20, 0.04);
  --claude-shadow-md: 0 4px 14px -2px rgba(30, 26, 20, 0.06), 0 1px 3px rgba(30, 26, 20, 0.03);
  --claude-shadow-lg: 0 16px 32px -6px rgba(30, 26, 20, 0.1), 0 4px 12px -2px rgba(30, 26, 20, 0.04);
  --claude-shadow-input: 0 2px 8px rgba(30, 26, 20, 0.04), 0 0 0 1px rgba(30, 26, 20, 0.07);
}

/* ================= DARK MODE ================= */
[data-theme="dark"], .dark {
  /* Canvas & Surfaces */
  --claude-bg-canvas: #1B1A17;          /* Warm espresso charcoal */
  --claude-bg-surface: #262521;         /* Sidebar & message cards */
  --claude-bg-surface-elevated: #2F2D28;/* Inputs, menus & modals */
  --claude-bg-subtle: #36342E;          /* Dark hover states */

  /* Text & Contrast */
  --claude-text-primary: #ECEAE5;       /* Warm cream white */
  --claude-text-secondary: #AAA69D;     /* Muted secondary text */
  --claude-text-tertiary: #77736A;      /* Placeholders */
  --claude-text-inverse: #1B1A17;

  /* Borders & Dividers */
  --claude-border-default: #383630;
  --claude-border-subtle: #2D2B26;
  --claude-border-focus: #E07A5F;

  /* Accent & Interaction */
  --claude-accent-primary: #E07A5F;     /* Slightly brighter for dark canvas */
  --claude-accent-hover: #EB8E75;
  --claude-accent-subtle: #3B2A24;
  --claude-accent-text: #FFFFFF;

  /* Code Syntax Blocks */
  --claude-code-bg: #151412;
  --claude-code-text: #ECEAE5;
  --claude-code-inline-bg: #2B2925;
  --claude-code-inline-text: #E58C73;

  /* Shadows */
  --claude-shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.35);
  --claude-shadow-md: 0 4px 16px rgba(0, 0, 0, 0.45);
  --claude-shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.6);
  --claude-shadow-input: 0 2px 10px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.08);
}
```

---

## 5. Border Radius & Spacing Rules

```yaml
border_radius:
  badge_tag: "4px - 6px"
  button: "8px - 10px"
  card: "12px - 14px"
  input_container: "16px - 20px"  # Large warm rounded input shell
  pill_capsule: "9999px"          # Filter pills, send button, model switch
  artifact_window: "12px"

spacing_system:
  chat_max_width: "48rem"         # ~768px (strict reading container)
  artifact_panel_width: "50vw"    # Split pane desktop width
  message_gap: "2rem"             # 32px between prompt & response
  paragraph_gap: "1.25rem"        # 20px between prose paragraphs
  container_padding: "1.5rem"
```

---

## 6. Style Chat Stream: Editorial Stream (Not Chat Bubbles)

### Critical Architectural Rule for AI Agents:
> **NO CHAT BUBBLES FOR THE ASSISTANT!**  
> Never render the AI response inside a rounded balloon with background color, speech notch, or cartoon avatar.

### Layout & Anatomy of the Conversation

```
+-------------------------------------------------------------------------+
|                                                                         |
|                            [User Message]                               |
|                  +-----------------------------------+                  |
|                  | "How does quantum teleportation   |                  |
|                  |  work in practice?"               |                  |
|                  +-----------------------------------+                  |
|                  (Warm subtle card, self-end / right)                   |
|                                                                         |
|  [Claude Response]                                                      |
|  *No enclosing bubble, completely unboxed editorial stream*             |
|                                                                         |
|  # Quantum Teleportation in Practice                                    |
|                                                                         |
|  Quantum teleportation is not the movement of physical matter, but      |
|  the instantaneous transfer of quantum state information...             |
|                                                                         |
|  +-------------------------------------------------------------------+  |
|  | [Code Block / Artifact]                                           |  |
|  | > High-contrast dark container with copy button & language pill   |  |
|  +-------------------------------------------------------------------+  |
|                                                                         |
|  (Ghost Action Bar: Copy | Thumbs Up | Thumbs Down | Retry | Share)     |
|  *Hidden by default, opacity: 1 on hover*                               |
+-------------------------------------------------------------------------+
```

### 1. User Message (Prompt Box)
- **Container:** Placed at the right/center-right or full-width with right alignment.
- **Style:** Light warm background (`var(--claude-bg-surface)`), subtle border (`var(--claude-border-default)`), generous rounded corners (`16px`).
- **Typography:** Sans-serif, 15px/16px, `var(--claude-text-primary)`.
- **Edit Action:** Subtle pencil icon button on hover to edit prompt.

### 2. Assistant Message (Editorial Prose Stream)
- **Container:** Completely unboxed. Background is `transparent`. Border is `none`.
- **Typography:**
  - Markdown headings render in **Serif** (`Lora`, `Newsreader`).
  - Paragraphs render in **Sans-serif** with large readable line-height (`1.72`).
  - Blockquotes have a 2px left border in `var(--claude-accent-primary)` with italicized serif text.
  - Lists have comfortable indentation with subtle bullet points.
- **Streaming State:**
  - Text streams smoothly.
  - The typing indicator is a subtle terracotta blinking vertical bar (`|`) or an amber breathing dot (`#D97757`), not bouncing grey dots.
- **Action Toolbar (Bottom of Assistant Message):**
  - Appears below the response.
  - Ghost buttons with 16px Lucide icons: `Copy`, `RotateCcw`, `ThumbsUp`, `ThumbsDown`.
  - Color: `var(--claude-text-tertiary)`, transitioning to `var(--claude-text-primary)` on hover.

### 3. Artifacts Panel (Sidecar Window)
Claude’s signature side-by-side artifact system:
- **Trigger Card in Chat:** A clean compact pill/card (`border: 1px solid var(--claude-border-default)`, radius: `10px`) showing icon, artifact title, language/type tag, and a chevron.
- **Expanded Drawer:** Slides out from the right (occupying ~45% to 55% of the viewport).
- **Header:** Title, "Code" / "Preview" segmented control switch, Copy button, Close button (`X`).
- **Surface:** Clear distinction between code view (dark theme Monaco/Prism styling) and live rendering iframe/component sandbox.

---

## 7. Chat Input Bar (The Claude Prompt Box)

The bottom prompt input is an iconic element of Claude’s UI:

```
+-------------------------------------------------------------------------+
|                                                                         |
|  +-------------------------------------------------------------------+  |
|  | Message Claude...                                                 |  |
|  |                                                                   |  |
|  |                                                                   |  |
|  |  [+] Attach (Paperclip)   [Model: Claude 3.7 Sonnet v]      [^]   |  |
|  +-------------------------------------------------------------------+  |
|                  *Warm floating card with soft shadow*                  |
+-------------------------------------------------------------------------+
```

### Visual Specifications
1. **Container:**
   - Background: `var(--claude-bg-surface-elevated)` (`#FFFFFF` in light, `#2F2D28` in dark).
   - Border: `1px solid var(--claude-border-default)`.
   - Focus State: `1px solid var(--claude-accent-primary)` + `box-shadow: 0 0 0 3px rgba(217, 119, 87, 0.12)`.
   - Border Radius: `16px` to `20px`.
   - Shadow: `var(--claude-shadow-input)`.
2. **Textarea:**
   - Auto-expanding, min-height `56px`, max-height `260px`.
   - Font: Sans-serif, 15px, `var(--claude-text-primary)`.
   - Placeholder: *"Reply to Claude..."* or *"How can Claude help you today?"* in `var(--claude-text-tertiary)`.
3. **Bottom Controls Row:**
   - **Attach Button:** Ghost button with `Paperclip` icon (18px).
   - **Model Selector Pill:** Warm capsule button with subtle model badge (e.g. `Claude 3.7 Sonnet`) and `ChevronDown`.
   - **Send Button:**
     - Circular button (`width: 32px; height: 32px; border-radius: 9999px`).
     - Disabled: `background: var(--claude-bg-subtle); color: var(--claude-text-tertiary)`.
     - Active (when text present): `background: var(--claude-accent-primary); color: #FFFFFF; transform: scale(1.02)`.
     - Icon: `ArrowUp` (18px, stroke-width: 2.2).

---

## 8. Iconography (Lucide Icons Guide)

Use [Lucide Icons](https://lucide.dev/) configured with:
- **Default Stroke Width:** `1.5px` (crucial for the light, bookish aesthetic; never use heavy 2.5px or solid fill icons).
- **Default Sizes:**
  - Micro / Inline: `14px`
  - Standard action buttons: `16px` - `18px`
  - Main navigation & headers: `20px`

### Icon Mapping Table

| UI Context | Recommended Lucide Icon | Usage Note |
| :--- | :--- | :--- |
| **New Chat** | `<SquarePen />` or `<Plus />` | Top sidebar action |
| **Send Message** | `<ArrowUp />` | Inside circular pill button |
| **Attachment** | `<Paperclip />` | Inside prompt bar |
| **Message Copy** | `<Copy />` / `<Check />` | Action bar below response |
| **Regenerate** | `<RotateCcw />` | Action bar below response |
| **Feedback** | `<ThumbsUp />` / `<ThumbsDown />` | Action bar below response |
| **Sidebar Collapse** | `<PanelLeftClose />` / `<PanelLeft />` | Header toggle |
| **Artifact Code** | `<Code2 />` | Artifact header tab |
| **Artifact Preview**| `<Eye />` or `<Play />` | Artifact preview tab |
| **Expand Artifact** | `<Maximize2 />` / `<Minimize2 />` | Fullscreen modal toggle |
| **Model Badge** | `<Sparkles />` | Next to model name |
| **Search History** | `<Search />` | Chat history search |
| **Delete Chat** | `<Trash2 />` | History context menu |
| **Settings** | `<Settings />` | Bottom sidebar profile link |

---

## 9. Tailwind CSS v3 / v4 Configuration Snippet

For agents generating code using Tailwind CSS, inject this configuration:

```javascript
// tailwind.config.js
module.exports = {
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        claude: {
          canvas: {
            DEFAULT: '#FAF9F5',
            dark: '#1B1A17',
          },
          surface: {
            DEFAULT: '#F3F1EC',
            elevated: '#FFFFFF',
            dark: '#262521',
            'dark-elevated': '#2F2D28',
          },
          border: {
            DEFAULT: '#E5E2D9',
            subtle: '#ECE9E2',
            dark: '#383630',
          },
          text: {
            primary: '#1E1E1E',
            secondary: '#68655E',
            tertiary: '#8F8B82',
            'dark-primary': '#ECEAE5',
            'dark-secondary': '#AAA69D',
            'dark-tertiary': '#77736A',
          },
          terracotta: {
            DEFAULT: '#D97757',
            hover: '#C96646',
            subtle: '#F7ECE6',
            dark: '#E07A5F',
            'dark-subtle': '#3B2A24',
          }
        }
      },
      fontFamily: {
        serif: ['Lora', 'Newsreader', 'Georgia', 'serif'],
        sans: ['Inter', 'Plus Jakarta Sans', 'system-ui', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      boxShadow: {
        'claude-input': '0 2px 10px rgba(30, 26, 20, 0.04), 0 0 0 1px rgba(30, 26, 20, 0.06)',
        'claude-card': '0 2px 8px -2px rgba(30, 26, 20, 0.06)',
      },
      borderRadius: {
        'claude-input': '18px',
      }
    },
  },
};
```

---

## 10. Agent Implementation Checklist (Rules & Guardrails)

When writing UI code pretending to be or matching Claude AI, the AI Agent **MUST** follow these rules:

- [ ] **RULE 1 (No Bubbles):** Do not wrap assistant responses in rounded speech boxes. Keep them transparent and editorial.
- [ ] **RULE 2 (No Pure Black/White):** Use `#FAF9F5` (light) and `#1B1A17` (dark) for canvas backgrounds.
- [ ] **RULE 3 (Serif for Headings):** Use editorial serif fonts (`Lora`, `Newsreader`, or `Georgia`) for all H1/H2 titles and welcome greetings.
- [ ] **RULE 4 (Terracotta Accent):** Use `#D97757` as the singular accent color (not blue, purple, or green).
- [ ] **RULE 5 (Centered Reading Width):** Restrict chat transcript max-width to `48rem` (`max-w-3xl`) for ideal typographical measure.
- [ ] **RULE 6 (Featherweight Icons):** Set Lucide icon `strokeWidth={1.5}` across all components.
- [ ] **RULE 7 (Streaming Caret):** When streaming, use an amber/terracotta pulsing vertical caret `|` without shaking layout.
- [ ] **RULE 8 (Quiet Hover States):** Make message copy and action buttons invisible or low opacity (`opacity-40` or `opacity-0`) until the user hovers over the message block.
