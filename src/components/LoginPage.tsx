import React, { useState } from 'react';
import { 
  Box, 
  Card, 
  TextField, 
  Button, 
  Typography, 
  Checkbox, 
  FormControlLabel, 
  IconButton, 
  InputAdornment,
  Alert,
  Stack
} from '@mui/material';
import { styled } from '@mui/material/styles';
import MailOutlineIcon from '@mui/icons-material/MailOutline';
import LockOutlinedIcon from '@mui/icons-material/LockOutlined';
import VisibilityIcon from '@mui/icons-material/Visibility';
import VisibilityOffIcon from '@mui/icons-material/VisibilityOff';
import LoginIcon from '@mui/icons-material/Login';

// Styled Components
const LoginContainer = styled(Box)(({ theme }) => ({
  minHeight: '100vh',
  background: 'linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%)',
  display: 'flex',
  alignItems: 'center',
  justifyContent: 'center',
  padding: theme.spacing(2),
  position: 'relative',
  overflow: 'hidden',
}));

const FloatingShape = styled(Box)<{ delay: number; size: number; top: string; left: string }>(({ delay, size, top, left }) => ({
  position: 'absolute',
  width: `${size}px`,
  height: `${size}px`,
  background: 'rgba(255, 255, 255, 0.1)',
  borderRadius: '50%',
  top,
  left,
  animation: `float 6s ease-in-out infinite`,
  animationDelay: `${delay}s`,
  '@keyframes float': {
    '0%, 100%': { 
      transform: 'translateY(0px) rotate(0deg)' 
    },
    '50%': { 
      transform: 'translateY(-20px) rotate(180deg)' 
    },
  },
}));

const GlassCard = styled(Card)(({ theme }) => ({
  background: 'rgba(255, 255, 255, 0.15)',
  backdropFilter: 'blur(20px)',
  borderRadius: '20px',
  border: '1px solid rgba(255, 255, 255, 0.2)',
  boxShadow: '0 8px 32px rgba(31, 38, 135, 0.37)',
  padding: theme.spacing(4),
  width: '100%',
  maxWidth: '450px',
  position: 'relative',
  overflow: 'hidden',
  animation: 'slideUp 0.8s ease-out',
  '&::before': {
    content: '""',
    position: 'absolute',
    top: 0,
    left: 0,
    right: 0,
    height: '1px',
    background: 'linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent)',
  },
  '@keyframes slideUp': {
    from: {
      opacity: 0,
      transform: 'translateY(30px)',
    },
    to: {
      opacity: 1,
      transform: 'translateY(0)',
    },
  },
}));

const ModernTextField = styled(TextField)(({ theme }) => ({
  '& .MuiOutlinedInput-root': {
    background: 'rgba(255, 255, 255, 0.1)',
    borderRadius: '12px',
    backdropFilter: 'blur(10px)',
    transition: 'all 0.3s ease',
    '& fieldset': {
      borderColor: 'rgba(255, 255, 255, 0.3)',
    },
    '&:hover fieldset': {
      borderColor: 'rgba(255, 255, 255, 0.5)',
    },
    '&.Mui-focused fieldset': {
      borderColor: 'rgba(255, 255, 255, 0.7)',
      boxShadow: '0 0 0 3px rgba(255, 255, 255, 0.1)',
    },
    '&.Mui-focused': {
      background: 'rgba(255, 255, 255, 0.2)',
      transform: 'translateY(-2px)',
    },
  },
  '& .MuiInputLabel-root': {
    color: 'rgba(255, 255, 255, 0.9)',
    '&.Mui-focused': {
      color: 'rgba(255, 255, 255, 1)',
    },
  },
  '& .MuiOutlinedInput-input': {
    color: 'white',
    '&::placeholder': {
      color: 'rgba(255, 255, 255, 0.6)',
      opacity: 1,
    },
  },
}));

const ModernButton = styled(Button)(({ theme }) => ({
  background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
  borderRadius: '12px',
  padding: theme.spacing(1.5, 3),
  fontWeight: 600,
  fontSize: '1.1rem',
  color: 'white',
  textTransform: 'uppercase',
  letterSpacing: '0.5px',
  position: 'relative',
  overflow: 'hidden',
  transition: 'all 0.3s ease',
  border: 'none',
  '&::before': {
    content: '""',
    position: 'absolute',
    top: 0,
    left: '-100%',
    width: '100%',
    height: '100%',
    background: 'linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent)',
    transition: 'left 0.5s ease',
  },
  '&:hover': {
    transform: 'translateY(-3px)',
    boxShadow: '0 10px 25px rgba(0, 0, 0, 0.2)',
    background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
    '&::before': {
      left: '100%',
    },
  },
  '&:active': {
    transform: 'translateY(-1px)',
  },
}));

const LoginTitle = styled(Typography)(({ theme }) => ({
  fontFamily: 'Space Grotesk, sans-serif',
  fontSize: '2.5rem',
  fontWeight: 700,
  color: 'white',
  textAlign: 'center',
  marginBottom: theme.spacing(1),
  textShadow: '0 2px 10px rgba(0, 0, 0, 0.3)',
  [theme.breakpoints.down('sm')]: {
    fontSize: '2rem',
  },
}));

const LoginSubtitle = styled(Typography)(({ theme }) => ({
  color: 'rgba(255, 255, 255, 0.8)',
  fontSize: '1.1rem',
  textAlign: 'center',
  marginBottom: theme.spacing(3),
}));

const StyledFormControlLabel = styled(FormControlLabel)(({ theme }) => ({
  '& .MuiFormControlLabel-label': {
    color: 'rgba(255, 255, 255, 0.9)',
    fontSize: '0.95rem',
  },
  '& .MuiCheckbox-root': {
    color: 'rgba(255, 255, 255, 0.7)',
    '&.Mui-checked': {
      color: 'white',
    },
  },
}));

const FooterLink = styled(Typography)(({ theme }) => ({
  textAlign: 'center',
  marginTop: theme.spacing(2),
  '& a': {
    color: 'rgba(255, 255, 255, 0.9)',
    textDecoration: 'none',
    fontWeight: 500,
    position: 'relative',
    transition: 'all 0.3s ease',
    '&::after': {
      content: '""',
      position: 'absolute',
      bottom: '-2px',
      left: 0,
      width: 0,
      height: '2px',
      background: 'white',
      transition: 'width 0.3s ease',
    },
    '&:hover': {
      color: 'white',
      '&::after': {
        width: '100%',
      },
    },
  },
}));

const ModernAlert = styled(Alert)(({ theme }) => ({
  background: 'rgba(248, 113, 113, 0.2)',
  border: '1px solid rgba(248, 113, 113, 0.3)',
  borderRadius: '12px',
  color: 'white',
  backdropFilter: 'blur(10px)',
  marginBottom: theme.spacing(2),
  '& .MuiAlert-icon': {
    color: 'white',
  },
}));

interface LoginPageProps {
  onSubmit?: (email: string, password: string, remember: boolean) => void;
  error?: string;
  loading?: boolean;
}

const LoginPage: React.FC<LoginPageProps> = ({ 
  onSubmit = () => {}, 
  error = '', 
  loading = false 
}) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [remember, setRemember] = useState(false);
  const [showPassword, setShowPassword] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    onSubmit(email, password, remember);
  };

  const togglePasswordVisibility = () => {
    setShowPassword(!showPassword);
  };

  return (
    <LoginContainer>
      {/* Floating Shapes */}
      <FloatingShape delay={0} size={80} top="10%" left="10%" />
      <FloatingShape delay={2} size={120} top="70%" left="80%" />
      <FloatingShape delay={4} size={60} top="40%" left="70%" />
      <FloatingShape delay={1} size={100} top="20%" left="80%" />

      <GlassCard>
        {/* Header */}
        <Box sx={{ mb: 3 }}>
          <LoginTitle>Welcome Back</LoginTitle>
          <LoginSubtitle>Sign in to continue to MyBlog</LoginSubtitle>
        </Box>

        {/* Error Display */}
        {error && (
          <ModernAlert severity="error" icon={false}>
            {error}
          </ModernAlert>
        )}

        {/* Login Form */}
        <Box component="form" onSubmit={handleSubmit}>
          <Stack spacing={2}>
            {/* Email Field */}
            <ModernTextField
              fullWidth
              label="Email Address"
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Enter your email"
              required
              InputProps={{
                startAdornment: (
                  <InputAdornment position="start">
                    <MailOutlineIcon sx={{ color: 'rgba(255, 255, 255, 0.6)' }} />
                  </InputAdornment>
                ),
              }}
            />

            {/* Password Field */}
            <ModernTextField
              fullWidth
              label="Password"
              type={showPassword ? 'text' : 'password'}
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              placeholder="Enter your password"
              required
              InputProps={{
                startAdornment: (
                  <InputAdornment position="start">
                    <LockOutlinedIcon sx={{ color: 'rgba(255, 255, 255, 0.6)' }} />
                  </InputAdornment>
                ),
                endAdornment: (
                  <InputAdornment position="end">
                    <IconButton
                      onClick={togglePasswordVisibility}
                      edge="end"
                      sx={{ color: 'rgba(255, 255, 255, 0.6)' }}
                    >
                      {showPassword ? <VisibilityOffIcon /> : <VisibilityIcon />}
                    </IconButton>
                  </InputAdornment>
                ),
              }}
            />

            {/* Remember Me */}
            <StyledFormControlLabel
              control={
                <Checkbox
                  checked={remember}
                  onChange={(e) => setRemember(e.target.checked)}
                />
              }
              label="Remember me for 30 days"
            />

            {/* Submit Button */}
            <ModernButton
              type="submit"
              fullWidth
              disabled={loading}
              startIcon={<LoginIcon />}
              sx={{ mt: 2 }}
            >
              {loading ? 'Signing In...' : 'Sign In'}
            </ModernButton>
          </Stack>
        </Box>

        {/* Footer */}
        <FooterLink>
          <Typography component="span" sx={{ color: 'rgba(255, 255, 255, 0.8)' }}>
            Don't have an account?{' '}
          </Typography>
          <a href="#register">Create one here</a>
        </FooterLink>
      </GlassCard>
    </LoginContainer>
  );
};

export default LoginPage;